import { TestBed } from '@angular/core/testing';

import { StringHelpersService } from './string-helpers.service';

describe('StringHelpersService', () => {
  let service: StringHelpersService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(StringHelpersService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
