import { Component, inject, OnInit } from '@angular/core';
import { Nivel } from '../../interfaces/nivel';
import { MAT_DIALOG_DATA, MatDialog, MatDialogModule, MatDialogRef } from '@angular/material/dialog';
import { FormBuilder, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatDividerModule } from '@angular/material/divider';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatSelectModule } from '@angular/material/select';
import { NivelService } from '../../../services/nivel.service';
import { Modal } from '../../interfaces/modal';
import { DialogComponent } from '../dialog/dialog-confirm.component';

@Component({
  selector: 'app-modal-confirmation',
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
  templateUrl: './modal-confirmation.component.html',
  styleUrl: './modal-confirmation.component.scss'
})
export class ModalConfirmationComponent {

  readonly dialogRef = inject(MatDialogRef<ModalConfirmationComponent>);
  readonly data = inject<Modal>(MAT_DIALOG_DATA);
  readonly dialog = inject(MatDialog)

  onCancel(): void {
    this.dialogRef.close(false)
  }

  onConfirm(): void {
    this.dialogRef.close(true)
  }
}
