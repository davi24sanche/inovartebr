import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { CartService } from 'src/app/share/cart.service';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-producto-index',
  templateUrl: './producto-index.component.html',
  styleUrls: ['./producto-index.component.css']
})
export class ProductoIndexComponent implements OnInit {
 datos:any;
 destroy$: Subject<boolean> = new Subject<boolean>();
 infoProducto:any;
  constructor(
    private gservice:GenericService,
    private notificacion: NotificacionService,
    private route: ActivatedRoute,
    private cartServive: CartService
  ) {

     this.listaProductos();
  }

  ngOnInit(): void {
  }

  listaProductos(){
    /*
    Utilizar el servicios genérico para listar los productos
    * Acción list indicando la ruta, recordando que indica únicamente lo que falta después de '//http://127.0.0.1:8000/api/p1/producto/
    * takeUntil cerrar la subscripción, cuando se destruye el componente
    * Subscripción a la solicitud
    * Opcional console.log solo si es necesario verificar los datos en tiempo de desarrollo
    * this.datos guardar la información en una variable, está se utilizará en el HTML para su respectiva presentación
    * capturar los errores y presentar una notificación
    * */

      this.gservice
      .list('producto/')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any)=>{
      console.log(data);
      this.datos=data;
      });
  }

  ngOnDestroy(){
    this.destroy$.next(true);
    this.destroy$.unsubscribe();
  }

  agregarProducto(id: number){
     this.gservice
     .get('producto', id)
     .pipe(takeUntil(this.destroy$))
     .subscribe((data: any) =>{
     this.infoProducto=data;
     this.cartServive.addToCart(this.infoProducto);
     this.notificacion.mensaje(
        'Orden',
        'Casa agregada a la orden',
        'success'
     );
     });
  }

}
