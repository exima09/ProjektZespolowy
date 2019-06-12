import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { JailJobComponent } from './jail-job.component';

describe('JailJobComponent', () => {
  let component: JailJobComponent;
  let fixture: ComponentFixture<JailJobComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ JailJobComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(JailJobComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
