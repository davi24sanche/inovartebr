import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleCreateComponent } from './detalle-create.component';

describe('DetalleCreateComponent', () => {
  let component: DetalleCreateComponent;
  let fixture: ComponentFixture<DetalleCreateComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleCreateComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(DetalleCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
