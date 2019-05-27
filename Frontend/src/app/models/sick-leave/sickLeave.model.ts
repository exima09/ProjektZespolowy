import { Prisoner } from "../prisoner/prisoner.model";
import { Worker } from "../worker/worker.model";

export class SickLeave {
    id?: number;
    worker: Worker;
    prisoner: Prisoner;
    reason: string;
    dateStop: string;
    dateStart: string;
}
