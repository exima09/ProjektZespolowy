import { Component, OnInit } from '@angular/core';
import {Cell} from "../../../models/cell/cell.model";
import {Block} from "../../../models/block/block.model";
import {BlockService} from "../../../services/block/block.service";
import {PrisonerService} from "../../../services/prisoner/prisoner.service";
import {Prisoner} from "../../../models/prisoner/prisoner.model";

@Component({
  selector: 'app-block',
  templateUrl: './block.component.html',
  styleUrls: ['./block.component.css']
})
export class BlockComponent implements OnInit {
  constructor(private service: BlockService, private prisonerService: PrisonerService) {}
  headerOfSite = 'Blok więzienny';
  loading = true;
  blocks: Block[] = [];
  prisoners: Prisoner[] = [];

  ngOnInit() {
    this.fetchBlocks();
    this.fetchPrisoners();
  }

  getBetweenCells = (first: number, last: number, block: Block): Cell[] => {
    return block.cells.filter((cell, index) => first <= index + 1 && index + 1 <= last);
  }

  fetchBlocks = () => {
    this.loading = true;
    this.service.getBlocks().subscribe((res: any) => {
      this.blocks = JSON.parse(res.blocks);
      this.loading = false;
    });
  }

  fetchPrisoners = () => {
    this.loading = true;
    this.prisonerService.getPrisoners().subscribe((res: any) => {
      this.prisoners = JSON.parse(res.prisoners).filter(prisoner => !prisoner.cell);
      this.loading = false;
    });
  }
}
