import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ProductoComponent } from './producto/producto.component';
import { ReservaComponent } from './reserva/reserva.component';
import { DetalleComponent } from './detalle/detalle.component';
import { ProductoShowComponent } from './producto-show/producto-show.component';
import { DetalleCreateComponent } from './detalle-create/detalle-create.component';
import { DetalleUpdateComponent } from './detalle-update/detalle-update.component';
import { ProductoCreateComponent } from './producto-create/producto-create.component'

const routes: Routes = [
  { path: 'casas/producto', component: ProductoComponent },
  { path: 'casas/reserva', component: ReservaComponent },
  { path: 'casas/detalle', component: DetalleComponent },
  { path: 'casas/detalle/create', component: DetalleCreateComponent },
  { path: 'casas/detalle/update/:id', component: DetalleUpdateComponent },
  { path: 'casas/producto/:id', component: ProductoShowComponent },
  { path: 'casas/producto/create', component: ProductoCreateComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CasasRoutingModule {}
