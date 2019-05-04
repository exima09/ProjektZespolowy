import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SickLeavesComponent } from './sick-leaves.component';

describe('SickLeavesComponent', () => {
  let component: SickLeavesComponent;
  let fixture: ComponentFixture<SickLeavesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SickLeavesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SickLeavesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
