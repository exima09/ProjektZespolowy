import {Component, OnInit} from '@angular/core';
import {PrisonerService} from 'src/app/services/prisoner/prisoner.service';
import {NgForm} from '@angular/forms';
import {AuthenticationService} from "../../../../services/authorization.service";
import {Cell} from "../../../../models/cell/cell.model";
import {BlockService} from "../../../../services/block/block.service";
import {Block} from "../../../../models/block/block.model";

@Component({
  selector: 'app-prisoner',
  templateUrl: './prisoner.component.html',
  styleUrls: ['./prisoner.component.css']
})
export class PrisonerComponent implements OnInit {
  headerOfSite = 'Rejestracja więźnia';
  cells: Cell[] = [];
  selectedCell = "";
  blocks: Block[];

  constructor(private service: PrisonerService, private blockService: BlockService, private auth: AuthenticationService) {
  }

  ngOnInit() {
    this.resetForm();
    this.fetchCells();
  }

  resetForm(form?: NgForm) {
    if (form != null) {
      form.resetForm();
    }
    this.service.formData = {
      id: null,
      firstName: '',
      lastName: '',
      joinDate: '',
      dateOfBirth: '',
      cell: undefined,
      executions: [],
      visits: [],
      sickLeaves: []
    };
  }

  onSubmit(form: NgForm) {
    if (form.value.id == null) {
      if (this.auth.checkLogin()) {
        this.insertRecord(form);
      }
    }
  }

  insertRecord(form: NgForm) {
    if (form.value.cell === "") {
      delete form.value.cell;
    }
    this.service.postPrisoner(form.value).subscribe(res => {
      console.log('Prisoner inserted successfully');
      this.fetchCells();
      this.resetForm(form);
    });
  }

  private fetchCells() {
    this.blockService.getBlocks().subscribe((res: any) => {
      this.blocks = JSON.parse(res.blocks);
      const cells: Cell[] = [];
      this.blocks.forEach(block => cells.push(...block.cells.filter(cell => !cell.prisoner)));
      this.cells = cells;
      this.selectedCell = "";
    });
  }

  getBlock(id: number) {
    return this.blocks.filter(block => block.cells.some(cell => cell.id === id))[0].name;
  }
}
