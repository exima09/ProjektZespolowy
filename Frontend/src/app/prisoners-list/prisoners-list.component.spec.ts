import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PrisonersListComponent } from './prisoners-list.component';

describe('PrisonersListComponent', () => {
  let component: PrisonersListComponent;
  let fixture: ComponentFixture<PrisonersListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PrisonersListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PrisonersListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
