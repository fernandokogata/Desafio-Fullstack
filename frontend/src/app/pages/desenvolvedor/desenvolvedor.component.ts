import { Component, inject, ViewChild } from '@angular/core';
import { FormBuilder, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatDialog } from '@angular/material/dialog';
import { MatDividerModule } from '@angular/material/divider';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatIconModule } from '@angular/material/icon';
import { MatInputModule } from '@angular/material/input';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSortModule, Sort } from '@angular/material/sort';
import { MatTableModule } from '@angular/material/table';
import { DialogComponent } from '../../shared/components/dialog/dialog-confirm.component';
import { ModalConfirmationComponent } from '../../shared/components/modal-confirmation/modal-confirmation.component';
import { SnackbarComponent } from '../../shared/components/snackbar/snackbar.component';
import { Modal } from '../../shared/interfaces/modal';
import { UtilsComponent } from '../../shared/utils/utils';
import { Desenvolvedor } from '../../shared/interfaces/desenvolvedor';
import { DesenvolvedorService } from '../../services/desenvolvedor.service';
import { ModalDesenvolvedorComponent } from './modal-desenvolvedor/modal-desenvolvedor.component';
import { MatSelectModule } from '@angular/material/select';

@Component({
  selector: 'app-desenvolvedor',
  imports: [
    FormsModule,
    ReactiveFormsModule,
    MatCardModule,
    MatInputModule,
    MatIconModule,
    MatButtonModule,
    MatFormFieldModule,
    MatDividerModule,
    MatTableModule,
    MatSortModule,
    MatPaginator,
    MatSelectModule
  ],
  templateUrl: './desenvolvedor.component.html',
  styleUrl: './desenvolvedor.component.scss'
})
export class DesenvolvedorComponent {
  @ViewChild(MatPaginator) paginator!: MatPaginator
  pageIndex: number = 0
  pageSize: number = 10
  totalRegisters: number = 0

  readonly dialog = inject(MatDialog)
  fb = inject(FormBuilder)
  desenvolvedorService = inject(DesenvolvedorService)

  snackBar: SnackbarComponent = new SnackbarComponent
  utilsComponent: UtilsComponent = new UtilsComponent

  form = this.fb.nonNullable.group({
    search: ['', Validators.required],
    columns: ['', Validators.required]
  })

  searchColumns = [
    { value: 'nome', label: 'Nome' },
    { value: 'sexo', label: 'Sexo' },
    { value: 'hobby', label: 'Hobby' }
  ]
  displayedColumns = ['id', 'nivel', 'nome', 'sexo', 'data_nascimento', 'hobby', 'actions']
  dataSource: Desenvolvedor[] = []
  sortedData: Desenvolvedor[] = []
  sortColumn: string = ''
  sortDirection: string = ''

  ngOnInit(): void {
    this.refresh()
  }

  async refresh(pageEvent: PageEvent = { length: 0, pageSize: 10, pageIndex: 0 }): Promise<void> {
    await this.desenvolvedorService.getAllDesenvolvedores(pageEvent.pageSize, pageEvent.pageIndex, `&${this.form.controls.columns.value}=${this.form.controls.search.value}`, this.sortColumn, this.sortDirection)
      .subscribe((response: any) => {
        this.dataSource = response.data
        this.sortedData = this.dataSource.slice()
        this.totalRegisters = response.meta.total
      })
  }

  sortData(sort: Sort): void {
    this.sortColumn = sort.active
    this.sortDirection = sort.direction
    this.refresh()
  }

  async filter(): Promise<void> {
    if (this.form.valid) {
      this.desenvolvedorService.getAllDesenvolvedores(10, 0, `&${this.form.controls.columns.value}=${this.form.controls.search.value}`, this.sortColumn, this.sortDirection)
        .subscribe((response: any) => {
          this.dataSource = response.data
          this.sortedData = this.dataSource.slice()
          this.totalRegisters = response.meta.total
        })
    }
  }

  openCreateDialog(): void {
    const dialogRef = this.dialog.open(ModalDesenvolvedorComponent, {
      disableClose: true
    })
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.refresh()
      }
    })
  }

  openUpdateDialog(desenvolvedor: Desenvolvedor): void {
    const dialogRef = this.dialog.open(ModalDesenvolvedorComponent, {
      data: desenvolvedor,
      disableClose: true
    })
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.refresh()
      }
    })
  }

  openDeleteDialog(desenvolvedor: Desenvolvedor): void {
    const dialogRef = this.dialog.open(ModalConfirmationComponent, {
      data: { title: 'Deletar', message: `Deseja realmente deletar o Desenvolvedor: ${desenvolvedor.nome}?`, success: true },
      disableClose: true
    })
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.desenvolvedorService.deleteDesenvolvedor(desenvolvedor.id!).subscribe({
          next: () => this.openDialog({ title: 'Sucesso!', message: `Desenvolvedor ${desenvolvedor.nome} excluído com sucesso!.`, success: true }),
          error: () => this.openDialog({ title: 'Falha!', message: `Não foi possível deletar o desenvolvedor ${desenvolvedor.nome}.`, success: false })
        })
      }
    })
  }

  openDialog(modal: Modal): void {
    const dialogRef = this.dialog.open(DialogComponent, {
      data: modal,
      disableClose: true,
      minWidth: '50vw'
    })
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.refresh()
      }
    })
  }
}
