import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FicheBouteilleComponent } from './fiche-bouteille.component';

describe('FicheBouteilleComponent', () => {
  let component: FicheBouteilleComponent;
  let fixture: ComponentFixture<FicheBouteilleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FicheBouteilleComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FicheBouteilleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
