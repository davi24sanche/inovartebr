import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleUpdateComponent } from './detalle-update.component';

describe('DetalleUpdateComponent', () => {
  let component: DetalleUpdateComponent;
  let fixture: ComponentFixture<DetalleUpdateComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleUpdateComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(DetalleUpdateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
