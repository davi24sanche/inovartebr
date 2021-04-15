import { Component, OnInit } from '@angular/core';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
} from '@angular/forms';
import { Subject } from 'rxjs';
import { Router, ActivatedRoute } from '@angular/router';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-producto-update',
  templateUrl: './producto-update.component.html',
  styleUrls: ['./producto-update.component.css']
})
export class ProductoUpdateComponent implements OnInit {
 producto: any;
  imageURL: string;
  formUpdate: FormGroup;
  destroy$: Subject<boolean> = new Subject<boolean>();
  makeSubmit: boolean = false;

  constructor(
    public fb: FormBuilder,
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {

    const id = +this.route.snapshot.paramMap.get('id');
    this.obtenerProducto(id);
    }

  ngOnInit(): void {
  }

  obtenerProducto(id: any){
    this.gService.get('producto', id).subscribe((respuesta: any) => {
      this.producto = respuesta;
      //Obtenida la información del producto
      //se construye el formulario
      this.reactiveForm();
  });
}

reactiveForm() {


    //Si hay información del producto
    if (this.producto) {

      //Cargar la información del producto
      //en los controles que conforman el formulario
      this.formUpdate = this.fb.group({
        id: [this.producto.id, [Validators.required]],
        nombre: [this.producto.nombre, [Validators.required]],
        descripcion: [this.producto.descripcion, [Validators.required]],

        precio: [
          this.producto.precio,
          [Validators.required, Validators.pattern('[0-9]+')],
        ],
        image: [''],

      });
      // Vista previa imagen
      this.imageURL = this.producto.pathImagen;
    }
  }

   //Obtener la imagen o archivo seleccionado
  onFileSelect(event) {
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      this.formUpdate.get('image').setValue(file);
      // Vista previa imagen
      const reader = new FileReader();
      reader.onload = () => {
        this.imageURL = reader.result as string;
      };
      reader.readAsDataURL(file);
    }
  }

   submitForm() {
    this.makeSubmit = true;

    let formData = new FormData();
    formData = this.gService.toFormData(this.formUpdate.value);
    formData.append('_method', 'PATCH');
    this.gService
      .update_formdata('producto', formData)
      .subscribe((respuesta: any) => {
        this.producto = respuesta;
        this.router.navigate(['/producto/show'], {
          queryParams: { update: 'true' },
        });
      });
  }
  onReset() {
    this.formUpdate.reset();
  }

  onBack() {
    this.router.navigate(['/producto/show']);
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formUpdate.controls[control].hasError(error) &&
      this.formUpdate.controls[control].invalid &&
      (this.makeSubmit || this.formUpdate.controls[control].touched)
    );
  };

}
