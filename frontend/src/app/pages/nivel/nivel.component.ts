import { Component, inject, OnInit, ViewChild } from '@angular/core';
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
import { SnackbarComponent } from '../../shared/components/snackbar/snackbar.component';
import { Nivel } from '../../shared/interfaces/nivel';
import { NivelService } from '../../services/nivel.service';
import { UtilsComponent } from '../../shared/utils/utils';
import { ModalNivelComponent } from './modal-nivel/modal-nivel.component';
import { ModalConfirmationComponent } from '../../shared/components/modal-confirmation/modal-confirmation.component';
import { Modal } from '../../shared/interfaces/modal';
import { DialogComponent } from '../../shared/components/dialog/dialog-confirm.component';

@Component({
  selector: 'app-nivel',
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
  templateUrl: './nivel.component.html',
  styleUrl: './nivel.component.scss'
})
export class NivelComponent implements OnInit {

  @ViewChild(MatPaginator) paginator!: MatPaginator
  pageIndex: number = 0
  pageSize: number = 10
  totalRegisters: number = 0

  readonly dialog = inject(MatDialog)
  fb = inject(FormBuilder)
  nivelService = inject(NivelService)

  snackBar: SnackbarComponent = new SnackbarComponent
  utilsComponent: UtilsComponent = new UtilsComponent

  form = this.fb.nonNullable.group({
    search: ['', Validators.required],
  })

  displayedColumns = ['id', 'nivel', 'desenvolvedor_count', 'actions']
  dataSource: Nivel[] = []
  sortedData: Nivel[] = []

  ngOnInit(): void {
    this.refresh()
  }

  async refresh(pageEvent: PageEvent = { length: 0, pageSize: 10, pageIndex: 0 }): Promise<void> {
    await this.nivelService.getAllNiveis(pageEvent.pageSize, pageEvent.pageIndex, this.form.controls.search.value )
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
        case 'nivel':
          return this.utilsComponent.compare(a.nivel, b.nivel, isAsc)
        default:
          return 0
      }
    })
  }

  async filter(): Promise<void> {
    if(this.form.valid) {
      this.nivelService.getAllNiveis(10, 0, this.form.controls.search.value)
        .subscribe((response: any) => {
          this.dataSource = response.data
          this.sortedData = this.dataSource.slice()
          this.totalRegisters = response.meta.total
        })
    }
  }

  openCreateDialog(): void {
    const dialogRef = this.dialog.open(ModalNivelComponent, {
      disableClose: true
    })
    dialogRef.afterClosed().subscribe(result => {
      if(result) {
        this.refresh()
      }
    })
  }

  openUpdateDialog(nivel: Nivel): void {
    const dialogRef = this.dialog.open(ModalNivelComponent, {
      data: nivel,
      disableClose: true
    })
    dialogRef.afterClosed().subscribe(result => {
      if(result) {
        this.refresh()
      }
    })
  }

  openDeleteDialog(nivel: Nivel): void {
    const dialogRef = this.dialog.open(ModalConfirmationComponent, {
      data: {title: 'Deletar', message: `Deseja realmente deletar o nível: ${nivel.nivel}?`, success: true},
      disableClose: true
    })
    dialogRef.afterClosed().subscribe(result => {
      if(result) {
        this.nivelService.deleteNivel(nivel.id!).subscribe({
          next: () => this.openDialog({title: 'Sucesso!', message: `Nível ${nivel.nivel} excluído com sucesso!.`, success: true}),
          error: () => this.openDialog({title: 'Falha!', message: `Não foi possível deletar o nível ${nivel.nivel}.`, success: false})
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
