import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CvManageComponent } from './cv-manage.component';

describe('CvManageComponent', () => {
  let component: CvManageComponent;
  let fixture: ComponentFixture<CvManageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CvManageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CvManageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
