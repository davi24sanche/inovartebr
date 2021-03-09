import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ProductoComponent } from './producto/producto.component';
import { ReservaComponent } from './reserva/reserva.component';
import { DetalleComponent } from './detalle/detalle.component';

const routes: Routes = [
  { path: 'casas/producto', component: ProductoComponent },
  { path: 'casas/reserva', component: ReservaComponent },
  { path: 'casas/detalle', component: DetalleComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CasasRoutingModule {}
