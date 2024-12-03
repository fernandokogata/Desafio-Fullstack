import { HttpClient } from '@angular/common/http';
import { Injectable, inject } from '@angular/core';
import { Observable } from 'rxjs';
import { Desenvolvedor } from '../shared/interfaces/desenvolvedor';

@Injectable({
  providedIn: 'root'
})
export class DesenvolvedorService {

  http = inject(HttpClient)

  constructor() { }

  getAllDesenvolvedores(pageSize: number, pageIndex: number, search?: string, orderColumn?: string, orderDirection?: string): Observable<any> {
    let query: string = ''
    query += search
    if(orderColumn && orderDirection) {
      query += `&order_column${orderColumn}$order_direction${orderDirection}`
    }
    return this.http.get(`http://localhost:8000/api/desenvolvedores?limit=${pageSize}&page=${pageIndex + 1}${search}`)
  }

  createDesenvolvedor(desenvolvedor: Desenvolvedor): Observable<any> {
    return this.http.post(`http://localhost:8000/api/desenvolvedores`, desenvolvedor)
  }

  updateDesenvolvedor(desenvolvedor: Desenvolvedor): Observable<any> {
    return this.http.put(`http://localhost:8000/api/desenvolvedores`, desenvolvedor)
  }

  deleteDesenvolvedor(id: number): Observable<any> {
    return this.http.delete(`http://localhost:8000/api/desenvolvedores/${id}`)
  }
}