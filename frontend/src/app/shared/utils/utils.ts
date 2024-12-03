import { AbstractControl, ValidationErrors, ValidatorFn } from "@angular/forms";

export class UtilsComponent {

  compare(a: string | number | Date, b: string | number | Date, isAsc: boolean): number {
    return (a < b ? -1 : 1) * (isAsc ? 1 : -1)
  }

  forbiddenCharacters(string: RegExp): ValidatorFn {
    return (control: AbstractControl): ValidationErrors | null => {
      const forbidden = string.test(control.value)
      return forbidden ? null : { forbiddenCharacters: { value: control.value } }
    }
  }
}
