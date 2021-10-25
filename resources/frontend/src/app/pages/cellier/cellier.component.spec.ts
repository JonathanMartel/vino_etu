import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CellierComponent } from './cellier.component';

describe('CellierComponent', () => {
  let component: CellierComponent;
  let fixture: ComponentFixture<CellierComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CellierComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CellierComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
