import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
declare let alertify: any;

@Component({
  selector: 'app-producto',
  templateUrl: './producto.component.html',
  styleUrls: ['./producto.component.css'],
})
export class ProductoComponent implements OnInit {
  datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService
  ) {}

  ngOnInit(): void {
    this.listaProductos();
  }


  crearProducto() {

    this.router.navigate(['/casas/producto/create'], {
      relativeTo: this.route,
    });

  }

   modificar(idProducto) {
    this.router.navigate(['update/' + idProducto], {
      relativeTo: this.route,
    });
  }

  eliminar(param) {
    this.gService
      .create('producto/' + param, param)
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        if (data == 1) {
          alertify.success('Eliminado Correctamente');
          this.listaProductos();
        } else {
          alertify.error('Ha ocurrido un error al eliminar');
        }
      });
  }

  listaProductos() {
    this.gService
      .list('producto/')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        this.datos = data;
      });
  }
  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }
}
