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
import { DetalleUpdateComponent } from './detalle-update/detalle-update.component';
import { ProductoCreateComponent } from './producto-create/producto-create.component';
import { ProductoUpdateComponent } from './producto-update/producto-update.component';

@NgModule({
  declarations: [
    ProductoComponent,
    ReservaComponent,
    DetalleComponent,
    ProductoShowComponent,
    DetalleCreateComponent,
    DetalleUpdateComponent,
    ProductoCreateComponent,
    ProductoUpdateComponent
  ],
  imports: [
    CommonModule,
    CasasRoutingModule,
    ReactiveFormsModule,
    BrowserAnimationsModule,
  ],
})
export class CasasModule {}
