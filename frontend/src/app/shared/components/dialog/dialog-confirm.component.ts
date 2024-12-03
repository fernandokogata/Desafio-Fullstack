import { Component, inject } from '@angular/core';
import { MatButtonModule } from '@angular/material/button';
import { MAT_DIALOG_DATA, MatDialogModule, MatDialogRef } from '@angular/material/dialog';
import { Modal } from '../../interfaces/modal';

@Component({
  selector: 'app-dialog',
  standalone: true,
  imports: [
    MatDialogModule,
    MatButtonModule
  ],
  templateUrl: './dialog.component.html',
  styleUrl: './dialog.component.scss'
})
export class DialogComponent {
  readonly dialogRef = inject(MatDialogRef<DialogComponent>)
  readonly data = inject<Modal>(MAT_DIALOG_DATA)

  onCloseSuccess() {
    this.dialogRef.close(true)
  }

  onCloseError() {
    this.dialogRef.close(false)
  }
}
