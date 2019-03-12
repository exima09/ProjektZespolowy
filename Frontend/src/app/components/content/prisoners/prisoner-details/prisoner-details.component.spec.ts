import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PrisonerDetailsComponent } from './prisoner-details.component';

describe('PrisonerDetailsComponent', () => {
  let component: PrisonerDetailsComponent;
  let fixture: ComponentFixture<PrisonerDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PrisonerDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PrisonerDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
