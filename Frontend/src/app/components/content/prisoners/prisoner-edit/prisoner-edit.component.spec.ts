import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PrisonerEditComponent } from './prisoner-edit.component';

describe('PrisonerEditComponent', () => {
  let component: PrisonerEditComponent;
  let fixture: ComponentFixture<PrisonerEditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PrisonerEditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PrisonerEditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
