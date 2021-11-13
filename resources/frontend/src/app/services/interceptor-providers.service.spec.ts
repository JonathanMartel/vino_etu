import { TestBed } from '@angular/core/testing';

import { InterceptorProvidersService } from './interceptor-providers.service';

describe('InterceptorProvidersService', () => {
  let service: InterceptorProvidersService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(InterceptorProvidersService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
