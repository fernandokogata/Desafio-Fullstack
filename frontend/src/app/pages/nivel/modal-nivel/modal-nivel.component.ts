import { Component, inject, OnInit } from '@angular/core';
import { Nivel } from '../../../shared/interfaces/nivel';
import { MAT_DIALOG_DATA, MatDialog, MatDialogModule, MatDialogRef } from '@angular/material/dialog';
import { FormBuilder, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatDividerModule } from '@angular/material/divider';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatSelectModule } from '@angular/material/select';
import { NivelService } from '../../../services/nivel.service';
import { Modal } from '../../../shared/interfaces/modal';
import { DialogComponent } from '../../../shared/components/dialog/dialog-confirm.component';

@Component({
  selector: 'app-modal-nivel',
  imports: [
    FormsModule,
    ReactiveFormsModule,
    MatDialogModule,
    MatDividerModule,
    MatFormFieldModule,
    MatSelectModule,
    MatInputModule,
    MatButtonModule
  ],
  templateUrl: './modal-nivel.component.html',
  styleUrl: './modal-nivel.component.scss'
})
export class ModalNivelComponent implements OnInit{

  readonly dialogRef = inject(MatDialogRef<ModalNivelComponent>);
  readonly data = inject<Nivel>(MAT_DIALOG_DATA);
  readonly dialog = inject(MatDialog)

  fb = inject(FormBuilder)
  nivelService = inject(NivelService)

  form = this.fb.nonNullable.group({
    id: [{ value: 0, disabled: true }],
    nivel: ['', Validators.required]
  })

  text: string = ''

  ngOnInit(): void {
    if(this.data) {
      this.form.controls.id.setValue(this.data.id!)
      this.form.controls.nivel.setValue(this.data.nivel)
      this.text = 'Alterar'
    } else {
      this.text = 'Criar'
    }
    
  }

  onCancel(): void {
    this.dialogRef.close(true)
  }

  onSubmit(): void {
    if (!this.form.controls.id.value && this.form.controls.nivel.value != '') {
      this.nivelService.createNivel({ id: null, nivel: this.form.controls.nivel.value })
        .subscribe({
          next: (response) => this.openDialog({ title: 'Sucesso!', message: `Nível: ${response.nivel} \n criado com sucesso.`, success: true })
        })
    }
    if (this.form.controls.id.value && this.form.controls.nivel.value != '') {
      this.nivelService.updateNivel({ id: this.form.controls.id.value, nivel: this.form.controls.nivel.value })
        .subscribe({
          next: (response) => this.openDialog({ title: 'Sucesso!', message: `Nível: ${response.nivel} \n alterado com sucesso.`, success: true })
        })
    }
  }

  openDialog(modal: Modal): void {
    const dialogRef = this.dialog.open(DialogComponent, {
      data: modal,
      disableClose: true,
      minWidth: '50vw'
    })
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.onCancel()
      }
    })
  }
}
