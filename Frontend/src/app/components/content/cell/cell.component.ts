import {Component, Input, OnInit} from '@angular/core';
import {Cell} from "../../../models/cell/cell.model";
import {Prisoner} from "../../../models/prisoner/prisoner.model";
import {BlockService} from "../../../services/block/block.service";
import {PrisonerService} from "../../../services/prisoner/prisoner.service";
import {MatSnackBar} from "@angular/material";
import * as moment from "moment";


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
  visibleDetails = false;

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

  setVisible(event) {
    this.visibleDetails = !this.visibleDetails;
  }

  ngOnInit(): void {
  }


  getLastVisit() {
    const lastVisit = this.cell.prisoner.visits[this.cell.prisoner.visits.length - 1];
    if (lastVisit) {
      return `${lastVisit.bookingPerson}, Kontakt: ${lastVisit.contact}, Data: ${moment(lastVisit.dateStart).format("DD-MM-YYYY")}, Zaakceptowana: ${lastVisit.statusAccepted ? "tak" : "nie"}`;
    } else {
      return "Brak wizyt";
    }
  }

  getLastSick() {
    const lastSick = this.cell.prisoner.sickLeaves[this.cell.prisoner.sickLeaves.length - 1];
    if (lastSick) {
      return ` Od ${moment(lastSick.dateStart).format("DD-MM-YYYY")} do ${lastSick.dateStop ? moment(lastSick.dateStart).format("DD-MM-YYYY") : '-'}, Wydane przez: ${lastSick.worker.user.firstName} ${lastSick.worker.user.lastName}, Powód: ${lastSick.reason ? lastSick.reason : "brak"} `;
    }
    return "Brak zwolnień";
  }

  getExecution() {
    const lastExecution = this.cell.prisoner.executions[this.cell.prisoner.executions.length - 1];
    const worker = lastExecution.worker.user;
    if (lastExecution) {
      return `Egzekucja: ${moment(lastExecution.executionDate).format("DD-MM-YYYY")}, Dodana przez: ${worker.firstName} ${worker.lastName} Ostatnie życzenie: ${lastExecution.lastWish ? lastExecution.lastWish : "-"}`;
    } else {
      return "Brak";
    }
  }
}
