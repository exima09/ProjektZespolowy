import { Component, OnInit } from '@angular/core';
import { SicknoteService } from 'src/app/services/sicknote.service';
import { SickLeave } from 'src/app/models/sick-leave/sickLeave.model';

@Component({
  selector: 'app-sick-leaves',
  templateUrl: './sick-leaves.component.html',
  styleUrls: ['./sick-leaves.component.css']
})
export class SickLeavesComponent implements OnInit {
  headerOfSite = "Lista zwolnień lekarskich";
  sickLeaves: SickLeave[];

  constructor(private sickService: SicknoteService) {
  }

  ngOnInit() {
    this.sickService.getSickNotes().subscribe((res: any) => {
      this.sickLeaves = JSON.parse(res.sickLeaves);
      this.sickLeaves.sort((a, b) => new Date(b.dateStart).getTime() - new Date(a.dateStart).getTime());
    });
  }

  sortByDateUp() {
    console.log("działa");
    this.sickLeaves.sort((a, b) => new Date(b.dateStart).getTime() - new Date(a.dateStart).getTime());
  }

  sortByDateDown() {
    this.sickLeaves.sort((a, b) => new Date(a.dateStart).getTime() - new Date(b.dateStart).getTime());
  }

  sortByPrisonerAZ() {
    this.sickLeaves.sort((a, b) => a.prisoner.lastName.localeCompare(b.prisoner.lastName));
  }

  sortByPrisonerZA() {
    this.sickLeaves.sort((a, b) => b.prisoner.lastName.localeCompare(a.prisoner.lastName));
  }
}
