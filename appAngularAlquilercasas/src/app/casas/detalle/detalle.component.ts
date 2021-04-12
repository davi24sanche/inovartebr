import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Toast } from 'ngx-toastr';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
declare let alertify: any;

@Component({
  selector: 'app-detalle',
  templateUrl: './detalle.component.html',
  styleUrls: ['./detalle.component.css'],
})
export class DetalleComponent implements OnInit {
  datos: any;
  notification: NotificacionService;


  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService
  ) {}

  ngOnInit(): void {
    this.listaDetalles();
  }

  crearDetalle() {
    this.router.navigate(['/casas/detalle/create'], {
      relativeTo: this.route,
    });
  }

  listaDetalles() {
    this.gService
      .list('producto/detalleShow')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        this.datos = data;
      });
  }

  //elimina el detalle
  eliminar(param) {
    alertify.confirm(
      'Desea eliminar este registro',
      function () {
        //confirma y hace la acción
        this.gService
          .create('producto/detalle/' + param, param)
          .pipe(takeUntil(this.destroy$))
          .subscribe((data: any) => {
            if (data == 1) {
              alertify.success('Eliminado Correctamente');
              this.listaDetalles();
            } else {
              alertify.error('Ha ocurrido un error al eliminar');
            }
          });
      },
      function () {
        //no hace nada
      }
    );

  }

  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }
}
