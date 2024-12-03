import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalNivelComponent } from './modal-nivel.component';

describe('ModalNivelComponent', () => {
  let component: ModalNivelComponent;
  let fixture: ComponentFixture<ModalNivelComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ModalNivelComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalNivelComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
