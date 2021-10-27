import { TestBed } from '@angular/core/testing';

import { BouteilleResolverServiceService } from './bouteille-resolver-service.service';

describe('BouteilleResolverServiceService', () => {
  let service: BouteilleResolverServiceService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(BouteilleResolverServiceService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
