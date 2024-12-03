import { Component, inject, OnInit } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialog, MatDialogModule, MatDialogRef } from '@angular/material/dialog';
import { FormBuilder, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatDividerModule } from '@angular/material/divider';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatSelectModule } from '@angular/material/select';
import { Modal } from '../../../shared/interfaces/modal';
import { DialogComponent } from '../../../shared/components/dialog/dialog-confirm.component';
import { Desenvolvedor } from '../../../shared/interfaces/desenvolvedor';
import { DesenvolvedorService } from '../../../services/desenvolvedor.service';
import {MatDatepickerModule} from '@angular/material/datepicker';
import { Nivel } from '../../../shared/interfaces/nivel';
import { NivelService } from '../../../services/nivel.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-modal-desenvolvedor',
  imports: [
    FormsModule,
    ReactiveFormsModule,
    MatDialogModule,
    MatDividerModule,
    MatFormFieldModule,
    MatSelectModule,
    MatInputModule,
    MatButtonModule,
    MatDatepickerModule
  ],
  templateUrl: './modal-desenvolvedor.component.html',
  styleUrl: './modal-desenvolvedor.component.scss'
})
export class ModalDesenvolvedorComponent implements OnInit {

  readonly dialogRef = inject(MatDialogRef<ModalDesenvolvedorComponent>);
  readonly data = inject<Desenvolvedor>(MAT_DIALOG_DATA);
  readonly dialog = inject(MatDialog)

  fb = inject(FormBuilder)
  router = inject(Router)
  desenvolvedorService = inject(DesenvolvedorService)
  nivelService = inject(NivelService)

  form = this.fb.nonNullable.group({
    id: [{ value: 0, disabled: true }],
    nivel_id: [0, Validators.required],
    nome: ['', Validators.required],
    sexo: ['', Validators.required],
    data_nascimento: [new Date(), Validators.required],
    hobby: ['', Validators.required]
  })

  sexos = [
    { value: "M", label: "Masculino" },
    { value: "F", label: "Feminino" },
  ];

  text: string = ''
  niveis: Nivel[] = []

  ngOnInit(): void {
    if (this.data) {
      this.form.controls.id.setValue(this.data.id!)
      this.form.controls.nivel_id.setValue(Number(this.data.nivel?.id))
      this.form.controls.nome.setValue(this.data.nome)
      this.form.controls.sexo.setValue(this.data.sexo)
      this.form.controls.data_nascimento.setValue(this.data.data_nascimento)
      this.form.controls.hobby.setValue(this.data.hobby)

      this.text = 'Alterar'
    } else {
      this.text = 'Criar'
    }
    this.getNiveis()
  }

  getNiveis():void {
    this.nivelService.getAllNiveis(999999, 0)
      .subscribe((result) =>  {
        if(result.data.length > 0) {
          this.niveis = result.data
        } else {
          this.openDialog({ title: 'Atenção!', message: `Cadastre ao menos 1(UM) nível para prosseguir.`, success: true })
          this.router.navigate(['/niveis'])
        }
      })
  }

  onCancel(): void {
    this.dialogRef.close(true)
  }

  onSubmit(): void {
    if (!this.form.controls.id.value &&
      this.form.controls.data_nascimento.value &&
      this.form.controls.nivel_id &&
      this.form.controls.nome.value != '' &&
      this.form.controls.sexo.value != '' &&
      this.form.controls.hobby.value != '') {
      this.desenvolvedorService.createDesenvolvedor({
        id: null,
        nivel_id: this.form.controls.nivel_id.value,
        nome: this.form.controls.nome.value,
        sexo: this.form.controls.sexo.value,
        data_nascimento: this.form.controls.data_nascimento.value,
        hobby: this.form.controls.hobby.value
      })
        .subscribe({
          next: (response) => this.openDialog({ title: 'Sucesso!', message: `Desenvolvedor: ${response.nome} \n criado com sucesso.`, success: true })
        })
    }
    if (this.form.controls.id.value &&
      this.form.controls.data_nascimento.value &&
      this.form.controls.nivel_id &&
      this.form.controls.nome.value != '' &&
      this.form.controls.sexo.value != '' &&
      this.form.controls.hobby.value != '') {
      this.desenvolvedorService.updateDesenvolvedor({
        id: this.form.controls.id.value,
        nivel_id: this.form.controls.nivel_id.value,
        nome: this.form.controls.nome.value,
        sexo: this.form.controls.sexo.value,
        data_nascimento: this.form.controls.data_nascimento.value,
        hobby: this.form.controls.hobby.value
      })
        .subscribe({
          next: (response) => this.openDialog({ title: 'Sucesso!', message: `Desenvolvedor: ${response.nome} \n alterado com sucesso.`, success: true })
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
