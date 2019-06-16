import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VisitReservationComponent } from './visit-reservation.component';

describe('VisitReservationComponent', () => {
  let component: VisitReservationComponent;
  let fixture: ComponentFixture<VisitReservationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VisitReservationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VisitReservationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
