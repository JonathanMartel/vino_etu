import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListeCelliersComponent } from './liste-celliers.component';

describe('ListeCelliersComponent', () => {
  let component: ListeCelliersComponent;
  let fixture: ComponentFixture<ListeCelliersComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListeCelliersComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ListeCelliersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
