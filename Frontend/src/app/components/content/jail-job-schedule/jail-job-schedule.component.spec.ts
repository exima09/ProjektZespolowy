import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { JailJobScheduleComponent } from './jail-job-schedule.component';

describe('JailJobScheduleComponent', () => {
  let component: JailJobScheduleComponent;
  let fixture: ComponentFixture<JailJobScheduleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ JailJobScheduleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(JailJobScheduleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
