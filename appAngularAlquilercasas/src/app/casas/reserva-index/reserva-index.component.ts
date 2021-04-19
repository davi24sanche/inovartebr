import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CartService, ItemCart } from 'src/app/share/cart.service';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-reserva-index',
  templateUrl: './reserva-index.component.html',
  styleUrls: ['./reserva-index.component.css']
})
export class ReservaIndexComponent implements OnInit {
items:ItemCart[] = [];
total = 0;
impuesto = 0;
fechaCreacion = new Date();
fechaInicio = new Date();
fechaFinal = new Date();
qtyItems= 0;
  constructor(
    private cartService: CartService,
    private notificacion: NotificacionService,
    private gService: GenericService,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.items = this.cartService.getItems();
    this.total = this.cartService.getTotal();
    this.impuesto = this.cartService.getImpuesto();

    this.cartService.countItems.subscribe((value)=>{
      this.qtyItems = value;
    });
  }

  eliminarItem(item:any){
    this.cartService.removeFromCart(item);
    this.total = this.cartService.getTotal();
    this.notificacion.mensaje('Reserva','Casa eliminada de la reserva','warning');
  }

  ordenar(){
    if(this.qtyItems >0){
      let detalles = {detalles: this.cartService.getItems()};
      this.gService
      .create('casas/reserva',detalles)
      .subscribe((respuesta: any) => {
       this.notificacion.mensaje(
         'Reserva',
         'La reserva se registro correctamente',
         'success'
       )
       this.cartService.deleteCart();
       this.items = this.cartService.getItems();
       this.impuesto = this.cartService.getImpuesto();
       this.total = this.cartService.getTotal();
      });
    }else{
      this.notificacion.mensaje('Reserva','Agregue casas a la reserva','warning');
    }
  }

}
