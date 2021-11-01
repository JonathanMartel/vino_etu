import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModifierCellierBouteilleComponent } from './modifier-cellier-bouteille.component';

describe('ModifierCellierBouteilleComponent', () => {
  let component: ModifierCellierBouteilleComponent;
  let fixture: ComponentFixture<ModifierCellierBouteilleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModifierCellierBouteilleComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ModifierCellierBouteilleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
