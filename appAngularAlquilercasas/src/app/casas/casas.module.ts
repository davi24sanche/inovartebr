import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CasasRoutingModule } from './casas-routing.module';
import { ProductoComponent } from './producto/producto.component';
import { ReservaComponent } from './reserva/reserva.component';
import { DetalleComponent } from './detalle/detalle.component';
import { ProductoShowComponent } from './producto-show/producto-show.component';
import { ReactiveFormsModule } from '@angular/forms';
import { DetalleCreateComponent } from './detalle-create/detalle-create.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

@NgModule({
  declarations: [
    ProductoComponent,
    ReservaComponent,
    DetalleComponent,
    ProductoShowComponent,
    DetalleCreateComponent,
  ],
  imports: [
    CommonModule,
    CasasRoutingModule,
    ReactiveFormsModule,
    BrowserAnimationsModule,
  ],
})
export class CasasModule {}
