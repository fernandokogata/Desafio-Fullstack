import { HttpClient } from '@angular/common/http';
import { Injectable, inject } from '@angular/core';
import { Observable } from 'rxjs';
import { Nivel } from '../shared/interfaces/nivel';

@Injectable({
  providedIn: 'root'
})
export class NivelService {

  http = inject(HttpClient)

  getAllNiveis(pageSize: number, pageIndex: number, search?: string): Observable<any> {
    let query = ''
    if(search && search != '') {
      query = `&nivel=${search}`
    }
    return this.http.get(`http://localhost:8000/api/niveis?limit=${pageSize}&page=${pageIndex + 1}${query}`)
  }

  createNivel(nivel: Nivel): Observable<any> {
    return this.http.post(`http://localhost:8000/api/niveis`, nivel)
  }

  updateNivel(nivel: Nivel): Observable<any> {
    return this.http.put(`http://localhost:8000/api/niveis`, nivel)
  }

  deleteNivel(id: number): Observable<any> {
    return this.http.delete(`http://localhost:8000/api/niveis/${id}`)
  }
}