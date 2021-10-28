import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CellierBouteilleComponent } from './cellier-bouteille.component';

describe('CellierBouteilleComponent', () => {
  let component: CellierBouteilleComponent;
  let fixture: ComponentFixture<CellierBouteilleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CellierBouteilleComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CellierBouteilleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
