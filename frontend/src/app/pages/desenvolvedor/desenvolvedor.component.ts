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
    MatPaginator
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
  })

  displayedColumns = ['id', 'nivel', 'nome', 'sexo', 'data_nascimento', 'hobby', 'actions']
  dataSource: Desenvolvedor[] = []
  sortedData: Desenvolvedor[] = []

  ngOnInit(): void {
    this.refresh()
  }

  async refresh(pageEvent: PageEvent = { length: 0, pageSize: 10, pageIndex: 0 }): Promise<void> {
    await this.desenvolvedorService.getAllDesenvolvedores(pageEvent.pageSize, pageEvent.pageIndex, this.form.controls.search.value )
      .subscribe((response: any) => {
        this.dataSource = response.data
        this.sortedData = this.dataSource.slice()
        this.totalRegisters = response.meta.total
      })
  }

  sortData(sort: Sort): void {
    const data = this.dataSource.slice()
    if (!sort.active || sort.direction === '') {
      this.sortedData = data
      return
    }
    this.sortedData = data.sort((a, b) => {
      const isAsc = sort.direction === 'asc'
      switch (sort.active) {
        case 'id':
          return this.utilsComponent.compare(Number(a.id), Number(b.id), isAsc)
        case 'nivel_id':
          return this.utilsComponent.compare(a.nivel_id, b.nivel_id, isAsc)
        case 'sexo':
          return this.utilsComponent.compare(a.sexo, b.sexo, isAsc)
        case 'data_nascimento':
          return this.utilsComponent.compare(new Date(a.data_nascimento), new Date(b.data_nascimento), isAsc)
        case 'hobby':
          return this.utilsComponent.compare(new Date(a.data_nascimento), new Date(b.data_nascimento), isAsc)
        default:
          return 0
      }
    })
  }

  async filter(): Promise<void> {
    if(this.form.valid) {
      this.desenvolvedorService.getAllDesenvolvedores(10, 0, this.form.controls.search.value)
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
      if(result) {
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
      if(result) {
        this.refresh()
      }
    })
  }

  openDeleteDialog(desenvolvedor: Desenvolvedor): void {
    const dialogRef = this.dialog.open(ModalConfirmationComponent, {
      data: {title: 'Deletar', message: `Deseja realmente deletar o Desenvolvedor: ${desenvolvedor.nome}?`, success: true},
      disableClose: true
    })
    dialogRef.afterClosed().subscribe(result => {
      if(result) {
        this.desenvolvedorService.deleteDesenvolvedor(desenvolvedor.id!).subscribe({
          next: () => this.openDialog({title: 'Sucesso!', message: `Desenvolvedor ${desenvolvedor.nome} excluído com sucesso!.`, success: true}),
          error: () => this.openDialog({title: 'Falha!', message: `Não foi possível deletar o desenvolvedor ${desenvolvedor.nome}.`, success: false})
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
