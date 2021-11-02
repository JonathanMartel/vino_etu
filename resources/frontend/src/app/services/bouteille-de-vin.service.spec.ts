import { TestBed } from '@angular/core/testing';
import { BouteilleDeVinService } from './bouteille-de-vin.service';

describe('BouteilleDeVinService', () => {
  let service: BouteilleDeVinService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(BouteilleDeVinService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
