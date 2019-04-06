import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PrisonerSickNoteComponent } from './prisoner-sick-note.component';

describe('PrisonerSickNoteComponent', () => {
  let component: PrisonerSickNoteComponent;
  let fixture: ComponentFixture<PrisonerSickNoteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PrisonerSickNoteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PrisonerSickNoteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
