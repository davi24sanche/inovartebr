import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CasasRoutingModule } from './casas-routing.module';
import { ProductoComponent } from './producto/producto.component';
import { ReservaComponent } from './reserva/reserva.component';
import { DetalleComponent } from './detalle/detalle.component';
import { ProductoShowComponent } from './producto-show/producto-show.component';


@NgModule({
  declarations: [ProductoComponent, ReservaComponent, DetalleComponent, ProductoShowComponent],
  imports: [CommonModule,CasasRoutingModule]
})
export class CasasModule { }
