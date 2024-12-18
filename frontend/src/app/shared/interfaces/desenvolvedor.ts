import { Nivel } from "./nivel";

export interface Desenvolvedor {
  id?: number | null,
  nivel? : Nivel,
  nivel_id: number | string,
  nome: string,
  sexo: string,
  data_nascimento: Date,
  hobby: string
}