import {Component, Input, OnInit} from '@angular/core';
import {Cell} from "../../../models/cell/cell.model";
import {Prisoner} from "../../../models/prisoner/prisoner.model";
import {BlockService} from "../../../services/block/block.service";
import {PrisonerService} from "../../../services/prisoner/prisoner.service";
import {MatSnackBar} from "@angular/material";


@Component({
  selector: 'app-cell',
  templateUrl: './cell.component.html',
  styleUrls: ['./cell.component.css']
})
export class CellComponent implements OnInit {


  constructor(private blockService: BlockService, private prisonerService: PrisonerService, public snackBar: MatSnackBar) {
  }

  visibleModal = false;
  loading = true;

  selectedOption: number = undefined;


  @Input() cell: Cell;
  @Input() prisoners: Prisoner[];
  @Input() fetchBlocks: () => void;
  @Input() fetchPrisoners: () => void;

  actionModal(event) {
    const {id} = event.target;
    if (id && id === "modal-confirm") {
      this.blockService.addPrisonerToCell({cellId: this.cell.id, prisonerId: this.selectedOption}).subscribe(() =>
          this.snackBar.open('Przypisano więźnia do celi', 'OK', {
            duration: 2000,
            panelClass: ['service-snackbar']
          }),
    err => {
          this.snackBar.open("Błąd", "Wystąpił błąd podczas przypisywania więźnia do celi", {
            duration: 2000,
            panelClass: ['service-snackbar']
          });
          console.log("ERROR", err);
        }
      );
      this.prisonerService.getPrisoners().subscribe((res: any) => {
        this.prisoners = JSON.parse(res.prisoners).filter(prisoner => !prisoner.cell);
        this.loading = false;
      });
      this.fetchBlocks();
      this.fetchPrisoners();
    }
    if (id && (id === "toggle-modal" || id === "modal-cancel" || id === "modal-confirm" || id === "plus") || id === "plus-wrapper") {
      this.visibleModal = !this.visibleModal;
    }
  }

  ngOnInit(): void {
  }


}
