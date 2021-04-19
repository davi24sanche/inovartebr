import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { Router } from '@angular/router';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { ActivatedRoute } from '@angular/router';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormControl,
} from '@angular/forms';

@Component({
  selector: 'app-detalle-update',
  templateUrl: './detalle-update.component.html',
  styleUrls: ['./detalle-update.component.css'],
})
export class DetalleUpdateComponent implements OnInit {
  detalle: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  formUpdate: FormGroup;
  tiposList: any;
  makeSubmit: boolean = false;
  id: any;

  constructor(
    public fb: FormBuilder,
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    const id = +this.route.snapshot.paramMap.get('id');
    this.obtenerDetalle(id);
  }

  ngOnInit(): void {}

  listaTipos() {
    this.gService
      .list('producto/tipo')
      .pipe(takeUntil(this.destroy$))
      .subscribe((datos: any) => {
        this.tiposList = datos;
      });
  }

  obtenerDetalle(id: any) {
    this.id = id;
    this.gService
      .get('producto/detalleShow', id)
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        //console.log(data);
        this.detalle = data;
        this.reactiveForm();
      });
  }

  reactiveForm() {
    this.listaTipos();
    this.formUpdate = this.fb.group({
      id: [this.route.snapshot.paramMap.get('id'), [Validators.required]],
      name: [this.detalle.name, [Validators.required]],
      description: [this.detalle.description, [Validators.required]],
      state: [this.detalle.state, [Validators.required]],
      price: [
        parseFloat(this.detalle.price),
        [Validators.required, Validators.pattern('[0-9]+')],
      ],
      tipo_id: [this.detalle.tipo_id, [Validators.required]],
    });
  }

  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }

  submitForm() {
    this.makeSubmit = true;
    let formData = new FormData();
    formData = this.gService.toFormData(this.formUpdate.value);
    formData.append('_method', 'PATCH');
    this.gService
      .update_formdata('producto/detalle', formData)
      .subscribe((respuesta: any) => {
        this.detalle = respuesta;
        this.router.navigate(['/casas/detalle'], {
          queryParams: { update: 'true' },
        });
      });
  }

  onReset() {
    this.formUpdate.reset();
  }
  onBack() {
    this.router.navigate(['/casas/detalle']);
  }
  public errorHandling = (control: string, error: string) => {
    return (
      this.formUpdate.controls[control].hasError(error) &&
      this.formUpdate.controls[control].invalid &&
      (this.makeSubmit || this.formUpdate.controls[control].touched)
    );
  };
}
