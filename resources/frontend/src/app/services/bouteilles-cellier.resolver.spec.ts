import { TestBed } from '@angular/core/testing';

import { BouteillesCellierResolver } from './bouteilles-cellier.resolver';

describe('BouteillesCellierResolver', () => {
  let resolver: BouteillesCellierResolver;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    resolver = TestBed.inject(BouteillesCellierResolver);
  });

  it('should be created', () => {
    expect(resolver).toBeTruthy();
  });
});
