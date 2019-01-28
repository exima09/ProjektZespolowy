import { TestBed } from '@angular/core/testing';

import { PrisonerService } from './prisoner.service';

describe('PrisonerService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: PrisonerService = TestBed.get(PrisonerService);
    expect(service).toBeTruthy();
  });
});
