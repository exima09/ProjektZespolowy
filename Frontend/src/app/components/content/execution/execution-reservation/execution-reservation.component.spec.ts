import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ExecutionReservationComponent } from './execution-reservation.component';

describe('EgzecutionReservationComponent', () => {
  let component: ExecutionReservationComponent;
  let fixture: ComponentFixture<ExecutionReservationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ExecutionReservationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ExecutionReservationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
