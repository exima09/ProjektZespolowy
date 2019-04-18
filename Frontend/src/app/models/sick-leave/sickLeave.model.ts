import { Prisoner } from "../prisoner/prisoner.model";

export class SickLeave {
    id?: number;
    workerId: number;
    prisonerId: Prisoner;
    reason: string;
    dateStop: Date;
    dateStart: Date;
}