import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AjoutCellierComponent } from './ajout-cellier.component';

describe('AjoutCellierComponent', () => {
  let component: AjoutCellierComponent;
  let fixture: ComponentFixture<AjoutCellierComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AjoutCellierComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(AjoutCellierComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
