import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { Router } from '@angular/router';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
} from '@angular/forms';

@Component({
  selector: 'app-detalle-create',
  templateUrl: './detalle-create.component.html',
  styleUrls: ['./detalle-create.component.css'],
})
export class DetalleCreateComponent implements OnInit {
  detalle: any;
  tiposList: any;
  error: any;
  makeSubmit: boolean = false;
  formCreate: FormGroup;
  destroy$: Subject<boolean> = new Subject<boolean>();

  constructor(
    public fb: FormBuilder,
    private router: Router,
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    this.reactiveForm();
  }
  ngOnInit(): void {
    this.listaTipos();
  }

  listaTipos() {
    this.gService
      .list('producto/tipo')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        this.tiposList = data;
      });
  }

  reactiveForm() {
    this.formCreate = this.fb.group({
      name: ['', [Validators.required]],
      description: ['', [Validators.required]],
      state: ['', [Validators.required]],
      price: ['', [Validators.required, Validators.pattern('[0-9]+')]],
      tipo_id: ['', [Validators.required]],
    });
  }

  submitForm() {
    this.makeSubmit = true;
    let formData = new FormData();
    formData = this.gService.toFormData(this.formCreate.value);
    formData.append('_method', 'POST');
    this.gService
      .create_formdata('producto/detalle', formData)
      .subscribe((respuesta: any) => {
        this.detalle = respuesta;
        this.router.navigate(['casas/detalle'], {
          queryParams: { register: 'true' },
        });
      });
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formCreate.controls[control].hasError(error) &&
      this.formCreate.controls[control].invalid &&
      (this.makeSubmit || this.formCreate.controls[control].touched)
    );
  };

  onReset() {
    this.formCreate.reset();
  }
  onBack() {
    this.router.navigate(['/casas/detalle']);
  }
}
