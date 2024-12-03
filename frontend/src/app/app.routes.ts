import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: '',
    redirectTo: 'desenvolvedores',
    pathMatch: 'full'
  },
  {
    path: 'niveis',
    title: 'NIVEIS',
    loadComponent: () => import('./pages/nivel/nivel.component').then((m) => m.NivelComponent)
  },
  {
    path: 'desenvolvedores',
    title: 'DESENVOLVEDORES',
    loadComponent: () => import('./pages/desenvolvedor/desenvolvedor.component').then((m) => m.DesenvolvedorComponent)
  },
];
