import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CasasRoutingModule } from './casas-routing.module';
import { ProductoComponent } from './producto/producto.component';


@NgModule({
  declarations: [ProductoComponent],
  imports: [
    CommonModule,
    CasasRoutingModule
  ]
})
export class CasasModule { }
