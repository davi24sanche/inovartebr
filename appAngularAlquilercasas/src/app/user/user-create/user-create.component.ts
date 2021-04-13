import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import {Subject} from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { AuthenticationService } from 'src/app/share/authentication.service';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-user-create',
  templateUrl: './user-create.component.html',
  styleUrls: ['./user-create.component.css']
})
export class UserCreateComponent implements OnInit {
  usuario: any;
  roles:any;
  error:any;
  formCreate:FormGroup;
  makeSubmit:boolean =false;
  destroy$:Subject<boolean>=new Subject<boolean>();


  constructor(
   public fb:FormBuilder,
   private router:Router,
   private gService: GenericService,
   private authService: AuthenticationService,
   private notificacion: NotificacionService

  ) {
    this.reactiveForm();
  }

  reactiveForm(){
    this.formCreate =this.fb.group({
      name:['',[Validators.required]],
      email:['',[Validators.required]],
      password:['',[Validators.required]],
      rol_id:['',[Validators.required]],
    });
    this.getRoles();
  }

  ngOnInit(): void {}
  submitForm(){
    this.makeSubmit=true;
    this.authService
    .createUser(this.formCreate.value)
    .subscribe((respuesta: any) => {
      this.usuario=respuesta;
      this.router.navigate(['/usuario/login'],{
        queryParams:{register:'true'},
      });
    });
  }
  onReset(){
    this.formCreate.reset();
  }
  getRoles(){
    this.gService
     .list('producto/rol')
     .pipe(takeUntil(this.destroy$))
     .subscribe((data:any)=>{
        this.roles = data;
     });

  }
  public errorHandling =(control:string,error:string)=>{
    return(
        this.formCreate.controls[control].hasError(error)&&
        this.formCreate.controls[control].invalid &&
        (this.makeSubmit  || this.formCreate.controls[control].touched)
    );
  };

}
